var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var ContCollap  = this.nextElementSibling;
            if (ContCollap .style.display === "block") {
            ContCollap .style.display = "none";
            } else {
            ContCollap .style.display = "block";
            }
        });
        }