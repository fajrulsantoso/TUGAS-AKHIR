<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Terbaru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .header {
            background-color: #730ae4;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 100%;
            height: auto;
        }
        .header h1 {
            margin: 20px 0 10px;
        }
        .header p {
            margin: 0 0 20px;
        }
        .header .contact-button {
            background-color: #8A4B08;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .products-section {
            padding: 50px 0;
            text-align: center;
        }
        .products-section h2 {
            margin-bottom: 20px;
            font-size: 32px;
        }
        .products-section p {
            margin-bottom: 40px;
            font-size: 18px;
            color: #666;
        }
        .products {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            width: calc(25% - 20px);
            box-sizing: border-box;
            margin: 10px;
        }
        .product:hover {
            transform: translateY(-5px);
        }
        .product img {
            width: 100%;
            height: auto;
        }
        .product-details {
            padding: 20px;
            text-align: left;
        }
        .product-details h3 {
            margin: 0 0 10px;
            font-size: 22px;
        }
        .product-details p {
            margin: 0 0 10px;
            color: #777;
        }
      
        .product img {
  width: 200px;
  height: 200px;
}
    </style>
</head>
<body>
    <div class="header">
        {{-- <img src="http://127.0.0.1:8000/storage/app/livewire-tmp/bagus.jpeg" width="150px" height="150px" alt="Tablet Image"> --}}
        <h1>Toko Karya Bhakti Sakti Gypsum</h1>
        <h3>Selamat Datang Di Website Kami</h3>
    <p>Kami memberikan layanan yang terbaik</p>

    <p>Wujudkan plafon dan dinding yang indah, modern, dan fungsional dengan gypsum. Nikmati desain fleksibel, ruangan lebih sejuk, kedap suara, tahan lama, dan pemasangan cepat. Hubungi kami sekarang untuk konsultasi gratis dan penawaran terbaik!.</p>
    </div>
    <div class="products-section">
        <h2>Produk Terbaru</h2>
        <p>Kualitas Terbaik. Harga Bersaing</p>
        
        <div class="products">
            @foreach ($products as $product)
            <div class="product">
                <img src="http://127.0.0.1:8000/storage/{{ $product->GambarProduk }}"alt="Product 1">
                <div class="product-details">
                    <h3>{{ $product->NamaProduk }}</h3>
                    <h3>{{ $product->StockProduk }}</h3>
                    <h3>{{ $product->DeskripsiProduk }}</h3>
                    <p class="price">Rp {{number_format($product->HargaProduk)}}</p>
                    <a href="https://wa.me/+6281249984615?text=Halo,%20saya%20ingin%20bertanya..." class="btn btn-primary">Pesan Via WhatsApp</a>

                </div>
            </div>
            @endforeach
        </div>
        
    </div>

    {{-- footer --}}
    <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="https://maps.app.goo.gl/FSSyprvtrr1Fmzmu9" class="nav-link px-2 text-body-secondary">Maps</a></li>
            <li class="nav-item"><a href="https://mail.google.com/mail/u/0/#inbox?compose=new" class="nav-link px-2 text-body-secondary">Email</a></li>
            <li class="nav-item"><a href="https://wa.me/+6281249984615?text=Halo,%20saya%20ingin%20bertanya..." class="nav-link px-2 text-body-secondary">Kontak</a></li>
            <li class=""><a href="https://wa.me/+6281249984615?text=Halo,%20saya%20ingin%20bertanya..." class="nav-link px-2 text-body-secondary">About</a></li>

          </ul>
          <p class="text-center text-body-secondary">© 2024 Fajrul & Yusuf</p>
        </footer>
      </div>
      {{-- end footer --}}
    {{-- <p>Silahkan hubungi kami melalui telepon dan whatsapp</p>
    <button class="contact-button">Kontak Kami</button>       --}}

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <body>
</html>
