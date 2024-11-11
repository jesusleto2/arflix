
//------------CAROUSEL 1 AUTOMATICO--------

var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 15000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

//------------CAROUSEL 2-----------

//------------CAROUSEL 2-----------
document.querySelectorAll('.wrapper').forEach(wrapper => {
    const carousel = wrapper.querySelector(".carousel");
    const arrowBtns = wrapper.querySelectorAll("i");
    const firstCardWidth = carousel.querySelector(".card").offsetWidth;
    const carouselChildren = [...carousel.children];

    let isDragging = false, startX, startScrollLeft;

    let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

    // Duplicar las primeras y últimas cartas para el desplazamiento infinito
    carouselChildren.slice(-cardPerView).reverse().forEach(card => {
        carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
    });

    carouselChildren.slice(0, cardPerView).forEach(card => {
        carousel.insertAdjacentHTML("beforeend", card.outerHTML);
    });

    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const scrollAmount = firstCardWidth * 4; // Desplazar 4 cartas
            carousel.scrollLeft += btn.id === "left" ? -scrollAmount : scrollAmount;
        });
    });

    const dragStart = (e) => {
        isDragging = true;
        carousel.classList.add("dragging");
        startX = e.pageX;
        startScrollLeft = carousel.scrollLeft;
    };

    const dragging = (e) => {
        if (!isDragging) return;
        carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
    };

    const dragStop = () => {
        isDragging = false;
        carousel.classList.remove("dragging");
    };

    const infiniteScroll = () => {
        if (carousel.scrollLeft === 0) {
            carousel.classList.add("no-transition");
            carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
            carousel.classList.remove("no-transition");
        } else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
            carousel.classList.add("no-transition");
            carousel.scrollLeft = carousel.offsetWidth;
            carousel.classList.remove("no-transition");
        }
    };

    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
    carousel.addEventListener("scroll", infiniteScroll);
});

//-----REDIRECCIONAMIENTO-----
function redirigirDetalle(id) {
    window.location.href = `models/detalle_pelicula.php?id=${id}`;
}

//--------SCROLL UP----------

const backToTop = document.getElementById("backToTop");

window.onscroll = function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTop.style.display = "block"; 
    } else {
        backToTop.style.display = "none";
    }
};


backToTop.addEventListener("click", function(event) {
    event.preventDefault();
    window.scrollTo({ top: 0, behavior: "smooth" });
});

// Alterna la visibilidad del menú desplegable al pasar el mouse sobre "Películas" o "Series"
document.querySelectorAll('.dropdown').forEach(dropdown => {
    const menu = dropdown.querySelector('.dropdown-menu');
    
    dropdown.addEventListener('mouseenter', () => {
        menu.classList.add('show');
    });

    dropdown.addEventListener('mouseleave', () => {
        menu.classList.remove('show');
    });
});

//buscador

// Escuchar cuando el usuario empieza a escribir en la barra de búsqueda
document.getElementById("searchInput").addEventListener("input", function() {
    const searchQuery = this.value;

    if (searchQuery.length > 0) {
        fetchResults(searchQuery);  // Llamar a la función de búsqueda
    } else {
        document.getElementById("searchResults").style.display = "none";  // Ocultar resultados si no hay texto
    }
});

// Realizar la búsqueda cuando se hace clic en el botón
function manualSearch() {
    const searchQuery = document.getElementById("searchInput").value;
    if (searchQuery.length > 0) {
        fetchResults(searchQuery);
    }
}

// Realizar una solicitud AJAX para obtener los resultados
function fetchResults(query) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "search.php?searchQuery=" + encodeURIComponent(query), true);
    xhr.onload = function() {
        if (this.status === 200) {
            const results = this.responseText;
            document.getElementById("searchResults").innerHTML = results;
            document.getElementById("searchResults").style.display = "block"; // Mostrar los resultados
        }
    };
    xhr.send();
}

// Ocultar resultados si se hace clic fuera del área de búsqueda
document.addEventListener("click", function(event) {
    const searchBar = document.querySelector(".search-bar");
    const searchResults = document.getElementById("searchResults");

    if (!searchBar.contains(event.target) && !searchResults.contains(event.target)) {
        searchResults.style.display = "none"; // Ocultar los resultados al hacer clic fuera
    }
});


// Obtener los elementos necesarios
const profilePic = document.getElementById('profilePic');
const dropdownMenu = document.getElementById('dropdownMenu');

// Función para mostrar/ocultar el menú desplegable
profilePic.addEventListener('click', function() {
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

// Cerrar el menú si el usuario hace clic fuera de él
window.addEventListener('click', function(event) {
    if (!event.target.matches('#profilePic') && !event.target.matches('#dropdownMenu') && !event.target.matches('#logoutLink')) {
        dropdownMenu.style.display = 'none';
    }
});


//perfil
function toggleSubmenu() {
    var submenu = document.querySelector('.submenu');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
}

