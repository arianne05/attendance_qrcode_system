var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
            this.querySelector(".accordion-icon.fa-minus").style.display = "none";
            this.querySelector(".accordion-icon.fa-plus").style.display = "inline-block";
        } else {
            panel.style.display = "block";
            this.querySelector(".accordion-icon.fa-minus").style.display = "inline-block";
            this.querySelector(".accordion-icon.fa-plus").style.display = "none";
        }
    });
}
