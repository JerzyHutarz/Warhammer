document.addEventListener('DOMContentLoaded', function () {
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.querySelector("table");
        switching = true;
        dir = "asc";
 
        while (switching) {
            switching = false;
            rows = table.rows;
 
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
 
                x = rows[i].querySelector(".table-cell:nth-child(" + (n + 1) + ")");
                y = rows[i + 1].querySelector(".table-cell:nth-child(" + (n + 1) + ")");
 
                if (dir === "asc" && isNaN(x.innerHTML)) {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "asc" && !isNaN(x.innerHTML)) {
                    if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc" && isNaN(x.innerHTML)) {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc" && !isNaN(x.innerHTML)) {
                    if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
 
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
 
    // Dodaj obsługę przycisku "Dodaj"
    // document.addEventListener('click', function (event) {
    //     if (event.target.classList.contains('btn')) {
    //         var idJednostki = event.target.dataset.id;
    //         dodajJednostke(idJednostki);
    //     }
    // });
 
    // // Dodaj funkcję do wysyłania żądania dodania jednostki
    // function dodajJednostke(id) {
    //     fetch(`php/dodaj.php?id_jednostki=${id}`)
    //         .then(response => response.text())
    //         .then(message => {
    //             console.log(message);
    //             location.reload(); // Odśwież stronę po dodaniu jednostki
    //         })
    //         .catch(error => {
    //             console.error('Błąd podczas dodawania jednostki', error);
    //         });
    // }
 });
 