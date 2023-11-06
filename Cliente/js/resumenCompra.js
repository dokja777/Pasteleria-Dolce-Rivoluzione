document.addEventListener("DOMContentLoaded", function() {
    var tarjeta_debito = document.getElementById("tarjeta_debito");
    var yape = document.getElementById("yape");
    var pago1 = document.getElementById("pago1");
    var pago2 = document.getElementById("pago2");

    tarjeta_debito.addEventListener("click", function() {
        pago1.style.display = "block";
        pago2.style.display = "none";
    });

    yape.addEventListener("click", function() {
        pago1.style.display = "none";
        pago2.style.display = "block";
    });
});