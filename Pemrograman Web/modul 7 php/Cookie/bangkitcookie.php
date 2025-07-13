<?php
// Bangkitkan cookie tanpa usia
setcookie("nama", "Ghildan");

// Bangkitkan cookie dengan usia 3600 detik
setcookie ("nama2", "Hanida", time() + 3600);

echo ("Cookie Anda telah diciptakan <br>");
echo ("Cookie Teman Anda telah dibentuk");
?>