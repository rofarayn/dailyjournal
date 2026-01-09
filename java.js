//waktu
function tampilWaktu(){
    var waktu = new Date();
    var bulan = waktu.getMonth() + 1;
    var hari = waktu.getDay();

    var namahari =  ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];


    document.getElementById("tanggal").innerHTML =
        namahari[hari] + ", " + waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();

    document.getElementById("jam").innerHTML =
        waktu.getHours() + ":" +
        waktu.getMinutes() + ":" +
        waktu.getSeconds();

    setTimeout(tampilWaktu, 1000);
}

//darkmode
const btnDark = document.getElementById("dark");
const btnLight = document.getElementById("light");
const navbar = document.querySelector(".navbar");
const hero = document.getElementById("hero");     
const gallery = document.getElementById("gallery"); 
const icons = document.querySelectorAll("footer i");


// tombol dark mode
  btnDark.addEventListener("click", function() {
  const body = document.body;

  body.classList.remove("bg-light", "text-dark");
  body.classList.add("bg-dark", "text-light");

  navbar.classList.remove("bg-body-tertiary", "navbar-light");
  navbar.classList.add("bg-dark", "navbar-dark");

  hero.style.backgroundColor = "rgb(116, 36, 100)";
  gallery.style.backgroundColor = "rgb(116, 36, 100)";

  icons.forEach(icon => {
  icon.classList.remove("text-dark");
  icon.classList.add("text-light");
  });
});

// tombol light mode
  btnLight.addEventListener("click", function() {
  const body = document.body;

  // set light mode
  body.classList.remove("bg-dark", "text-light");
  body.classList.add("bg-light", "text-dark");
  
  navbar.classList.remove("bg-dark", "navbar-dark");
  navbar.classList.add("bg-body-tertiary", "navbar-light");

  hero.style.backgroundColor = "rgb(255, 128, 206)";
  gallery.style.backgroundColor = "rgb(255, 128, 206)";

  icons.forEach(icon => {
  icon.classList.remove("text-light");
  icon.classList.add("text-dark");
  });
});