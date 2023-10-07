let arrow = document.querySelectorAll('.arrow');
for (let i = 0; i < arrow.length; i++) {
	arrow[i].addEventListener('click', (e) => {
		let arrowParent = e.target.parentElement.parentElement;
		arrowParent.classList.toggle('showMenu');
	});
}
 
let sidebar = document.querySelector('.sidebar');
let sidebarBtn = document.querySelector('.fa-bars');
sidebarBtn.addEventListener('click', () => {
	sidebar.classList.toggle('close');
});

// Obtén elementos del DOM
const logoImage = document.querySelector('.logo-details img');

// Agrega un controlador de eventos al hacer clic en el logo
logoImage.addEventListener('click', () => {
  sidebar.classList.toggle('close'); // Abre o cierra el sidebar al hacer clic
});