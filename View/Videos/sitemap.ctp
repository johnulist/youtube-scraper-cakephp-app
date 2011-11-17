<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<url>
<loc>http://www.domain.com/</loc>
</url>
<?php foreach($videos as $video): ?>
<url>
<loc>http://www.domain.com/<?php echo $video['Video']['slug']; ?></loc>
</url>
<?php endforeach; ?>
</urlset>
