 <!-- footer -->
 <footer class="footer mt-auto text-white-50 py-5" style="backdrop-filter: blur(12px); background: rgba(30, 41, 59, 0.8); border-top: 1px solid rgba(255,255,255,0.05);">
     <div class="container px-4">
         <div class="row gy-4 align-items-start">
             <!-- Brand -->
             <div class="col-md-4">
                 <img src="/assets/icon/seminair.png" alt="Seminair Logo" width="130" class="mb-3">
                 <p style="font-size: 14px; color: rgba(255,255,255,0.6);">
                     Membuka wawasan melalui seminar dan webinar terbaik dari para ahli di bidangnya.
                 </p>
                 <!-- Social Media Icons -->
                 <div class="d-flex align-items-center justify-content-center justify-content-xl-start gap-3 mt-3">
                     <a href="https://www.instagram.com/ipologize/" class="footer-icon"><i class="bi bi-instagram"></i></a>
                     <a href="wa.me/6289681117903" class="footer-icon"><i class="bi bi-whatsapp"></i></a>
                     <a href="../views/contact.php" class="footer-icon"><i class="bi bi-envelope"></i></a>
                 </div>
             </div>

             <!-- Menu Links -->
             <div class="col-md-4">
                 <h6 class="text-white mb-3">Navigasi</h6>
                 <ul class="list-unstyled">
                     <li><a href="/" class="footer-link">Home</a></li>
                     <li><a href="/src/views/events.php" class="footer-link">Events</a></li>
                     <li><a href="/src/views/about.php" class="footer-link">About Us</a></li>
                     <li><a href="/src/views/contact.php" class="footer-link">Contact Us</a></li>
                 </ul>
             </div>

             <!-- Contact Info -->
             <div class="col-md-4">
                 <h6 class="text-white mb-3">Hubungi Kami</h6>
                 <p class="mb-1"><i class="bi bi-geo-alt me-2"></i> Jl. Rungkut Madya, Gn. Anyar, Kec. Gn. Anyar, Surabaya, Jawa Timur 60294</p>
                 <p class="mb-1"><i class="bi bi-envelope me-2"></i> support@seminair.id</p>
                 <p><i class="bi bi-whatsapp me-2"></i> +62 896-68111-7903</p>
             </div>
         </div>

         <hr class="my-4 border-light" style="opacity: 0.1;">

         <!-- Footer Bottom -->
         <div class="text-center" style="font-size: 13px; color: rgba(255,255,255,0.4);">
             &copy; <?= date("Y") ?> Seminair. All rights reserved.
         </div>
     </div>
 </footer>

 <style>
     .footer-link {
         text-decoration: none;
         display: inline-block;
         color: rgba(255, 255, 255, 0.7);
         padding: 4px 0;
         transition: all 0.3s ease;
         font-size: 14px;
     }

     .footer-link:hover {
         color: #fff;
         text-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
         transform: translateX(3px);
     }

     .footer-icon {
         font-size: 18px;
         color: rgba(255, 255, 255, 0.6);
         transition: all 0.3s ease;
     }

     .footer-icon:hover {
         color: #fff;
         text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
         transform: scale(1.15);
     }

     @media (max-width: 768px) {
         .footer .row>div {
             text-align: center;
         }
     }
 </style>