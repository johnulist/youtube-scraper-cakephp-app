<?php
class VideosController extends AppController {

	public $components = array('RequestHandler');

//////////////////////////////////////////////////

	private function _randomizer() {
		$ids = $this->Video->find('all', array(
			'recursive' => -1,
			'fields' => array('Video.id'),
			'condition' => array(
				'Video.is_active' => 1,
			),
		));
		shuffle($ids);
		array_splice($ids, 10);
		$d = array();
		foreach($ids as $id) {
			$d[] = $id['Video']['id'];
		}
		return $d;
	}

//////////////////////////////////////////////////

	private function _getVideos($limit = 10) {
	 	$records = $this->Video->find('all', array(
			'recursive' => -1,
			'limit' => $limit,
			'conditions' => array(
				'Video.id' => $this->_randomizer(),
				'Video.is_active' => 1,
			),
		));
		shuffle($records);
		return $records;
	}

//////////////////////////////////////////////////

	public function index() {
		$title_for_layout = 'Youtube Videos';
		$keywords = 'videos';
		$description = 'Videos';
		$videos = $this->_getVideos(20);
		$this->set(compact('title_for_layout', 'keywords', 'description', 'videos'));
	}

//////////////////////////////////////////////////

	public function view($id = null) {
		
		$video = $this->Video->find('first', array(
			// 'contain' => array('Lyric'),
			'conditions' => array('Video.slug' => $id),
		));
		if(!$video) {
			$this->redirect('/');
		}
		
		$this->Video->updateAll(
			array('Video.views' => 'Video.views + 1'),
			array('Video.id' =>  $video['Video']['id'])
		);

		$videos = $this->Video->find('all', array(
			'conditions' => array('Video.uploader' => $video['Video']['uploader']),
			'order' => 'RAND()',
			'limit' => 5,
		));
		if(count($videos) < 5) {
			$videos = $this->_getVideos(5);
		}

		
		$title_for_layout = $video['Video']['name'] . ' Music Video';
		$keywords = $video['Video']['keywords'];
		$description = $video['Video']['name'];
		
		$this->set(compact('title_for_layout', 'keywords', 'description', 'video', 'videos'));
	}

//////////////////////////////////////////////////

	public function search() {
		
		$search = null;
		if(!empty($this->request->query['search']) || !empty($this->request->data['name'])) {
			$search = empty($this->request->query['search']) ? $this->request->data['name'] : $this->request->query['search'] ;
			$search = preg_replace("/[^a-zA-Z0-9 ]/", '', $search);
			$terms = explode(' ', trim($search));
			$terms = array_diff($terms, array(''));
			$conditions = array();
			foreach($terms as $term) {
				$terms1[] = preg_replace("/[^a-zA-Z0-9]/", '', $term);
				$conditions[] = array('Video.name LIKE' => '%' . $term . '%');
			}
			$videos = $this->Video->find('all', array(
	            'conditions' => $conditions,
				'limit' => 200,
				'recursive' => -1
			));
			$terms1 = array_diff($terms1, array(''));
			$this->set(compact('videos', 'terms1'));
		}
		$this->set(compact('search'));

		if ($this->request->is('ajax')) {
			$this->layout = false;
			$this->set('ajax', 1);
	    } else {
			$this->set('ajax', 0);
		}

		$this->set('title_for_layout', 'Search');

	    $description = 'Search';
		$this->set(compact('description'));

	    $keywords = 'search';
		$this->set(compact('keywords'));
	}

//////////////////////////////////////////////////

	public function searchjson() {

		$search = null;
		if(!empty($this->request->query['term'])) {
			$search = $this->request->query['term'];
			$terms = explode(' ', trim($search));
			$terms = array_diff($terms, array(''));
			$conditions = array();
			foreach($terms as $term) {
				$conditions[] = array('Video.name LIKE' => '%' . $term . '%');
			}
			$videos = $this->Video->find('all', array(
	            'conditions' => $conditions,
				'limit' => 200,
				'recursive' => -1
			));
			foreach($videos as $video) {
				$videos1[] = $video['Video']['name'];
			} 
			$this->set(compact('videos1'));
		}
	}

//////////////////////////////////////////////////

	public function rating() {

		$id = $this->request->query['id'];
		$rates = $this->request->query['rating'];

		$video = $this->Video->find('first', array(
			'recursive' => -1,
            'conditions' => array(
            	'Video.id' => $id
            )
		));

		$newRates = $video['Video']['rates'] + $rates;
		$newVotes = $video['Video']['votes'] + 1;
		$newRating = $newRates / $newVotes;

		$this->Video->updateAll(
			array(
				'Video.rates' => $newRates,
				'Video.votes' => $newVotes,
				'Video.rating' => $newRating,
			),
			array('Video.id' => $video['Video']['id'])
		);

		$resultNice = number_format($newRating * 5, 2);

		$results = array('result' => $newRating, 'resultNice' => $resultNice);
		echo json_encode($results);
		die();
	}

//////////////////////////////////////////////////

	public function sitemap() {
		$videos = $this->Video->find('all', array(
			'recursive' => -1,
		));
		$this->set(compact('videos'));
		$this->layout = 'xml';
		$this->response->type('xml');
	}

//////////////////////////////////////////////////

	public function admin_import(){
		
		$name = null;
		$type = null;
		if(!empty($this->request->query['type']) && !empty($this->request->query['name'])) {
		
			$this->Session->delete('items');
			
			$type = $this->request->query['type'];
			$name = $this->request->query['name'];

			$start = 1;
			if(!empty($this->request->query['start'])) {
				$start = $this->request->query['start'];
			}
			
			App::uses('Sanitize', 'Utility');
			App::uses('Xml', 'Utility');
			
			$url = 'http://gdata.youtube.com/feeds/api/videos?' . $type .  '=' . urlencode($name) . '&start-index=' . $start . '&max-results=50&strict=true';
			
			$itemsTemp = Xml::toArray(Xml::build($url));
			
			if(!$itemsTemp['feed']['entry'][0]) {
				$this->Session->setFlash('Not enough video results..');
				$this->redirect(array('action' => 'import'));
			}
			
			$items = array();
			foreach($itemsTemp['feed']['entry'] as $item) {
			
				// print_r($item);
			
				$videoId = str_replace('http://gdata.youtube.com/feeds/api/videos/', null, $item['id']);

				$i = String::uuid();

				$items[$i]['uuid'] = $i;
				$items[$i]['vid'] = $videoId;

				$slug = strtolower($item['title']['@']);
				$slug = Inflector::slug($slug, '-');
				$slug = Sanitize::paranoid($slug, array('-'));
				$slug = str_replace('--', '-', $slug);
				$items[$i]['slug'] = $slug;
				
				$items[$i]['name'] = $item['title']['@'];
				$items[$i]['description'] = empty($item['content']['@']) ? '' : $item['content']['@'];
		        $items[$i]['keywords'] = Inflector::slug(strtolower($item['title']['@']), ',');
				$items[$i]['thumbnail'] = $item['media:group']['media:thumbnail'][0]['@url'];
				
				$items[$i]['uploader'] = $item['author']['name'];
				
				$seconds = $item['media:group']['yt:duration']['@seconds'];
				$items[$i]['seconds'] = $seconds;
				$items[$i]['minutes'] = sprintf('%02.2d:%02.2d', floor($seconds / 60), $seconds % 60);	
				
				$items[$i]['is_active'] = 1;
			}
			
			$this->set(compact('items'));
			$this->Session->write('items', $items);
			
		}
		$this->set(compact('name', 'type'));
		
	}

//////////////////////////////////////////////////

	public function admin_importadd() {

		$items = $this->Session->read('items');

		if(!empty($items)) {
		    foreach($this->request['data']['Video']['sel'] as $uuid)  {
		      if($uuid !== 0) {
				$existing = $this->Video->find('count', array(
					'conditions' => array(
						'OR' => array(
							array('Video.vid' => $items[$uuid]['vid']),
							array('Video.slug' => $items[$uuid]['slug'])
						)
					)
				));
				if($existing == 0) {
					$this->Video->recursive = 0;
			        $this->Video->create();
			        $video['Video'] = $items[$uuid];
			        $save = $this->Video->save($video, false);
				}
		      }
		    }
			$this->Session->delete('items');		
		}

	    $this->redirect(array('controller' => 'videos', 'action' => 'index'));

	}

//////////////////////////////////////////////////

	public function admin_uploader() {
		$videos = $this->Video->find('all', array(
			'fields' => array(
				'Video.uploader'
			),
			'group' => 'Video.uploader',
			'order' => 'Video.uploader ASC',
		));
		$videos = Set::extract('/Video/uploader', $videos);
		$this->set(compact('videos'));
	}

//////////////////////////////////////////////////

	public function admin_index() {
		$this->Video->recursive = 0;
		$this->set('videos', $this->paginate());
	}

//////////////////////////////////////////////////

	public function admin_view($id = null) {
		$this->Video->id = $id;
		if (!$this->Video->exists()) {
			throw new NotFoundException(__('Invalid video'));
		}
		$this->set('video', $this->Video->read(null, $id));
	}

//////////////////////////////////////////////////

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Video->create();
			if ($this->Video->save($this->request->data)) {
				$this->Session->setFlash(__('The video has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.'));
			}
		}
	}

//////////////////////////////////////////////////

	public function admin_edit($id = null) {
		$this->Video->id = $id;
		if (!$this->Video->exists()) {
			throw new NotFoundException(__('Invalid video'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Video->save($this->request->data)) {
				$this->Session->setFlash(__('The video has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Video->read(null, $id);
		}
	}

//////////////////////////////////////////////////

	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Video->id = $id;
		if (!$this->Video->exists()) {
			throw new NotFoundException(__('Invalid video'));
		}
		if ($this->Video->delete()) {
			$this->Session->setFlash(__('Video deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Video was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

//////////////////////////////////////////////////

}
