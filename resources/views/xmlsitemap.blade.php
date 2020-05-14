

<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>

        <loc>http://www.cardesta.com/</loc>

        <lastmod><?php echo date('d-m-Y');?></lastmod>

        <changefreq>monthly</changefreq>

        <priority>1.0</priority>

    </url>

    <url>

        <loc>http://www.cardesta.com/list</loc>

        <lastmod><?php echo date('d-m-Y');?></lastmod>

        <changefreq>monthly</changefreq>

        <priority>1.0</priority>

    </url>

    <url>

        <loc>http://www.cardesta.com/dealers</loc>

        <lastmod><?php echo date('d-m-Y');?></lastmod>

        <changefreq>monthly</changefreq>

        <priority>1.0</priority>

    </url>
   @foreach($products as $product)
    <url>

        <loc>http://www.cardesta.com/@php echo strtolower(str_replace(' ','-',$product->dealer->name))??'car-dealer-solutions';@endphp/{{$product->dealer->zip}}/{{$product->vin}}</loc>

        <lastmod><?php echo date('d-m-Y');?></lastmod>

        <changefreq>monthly</changefreq>

        <priority>1.0</priority>

    </url>
       @endforeach


</urlset>

