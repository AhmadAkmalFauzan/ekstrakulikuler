const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})

function updateClock() {
	const now = new Date();
	const date = now.toLocaleDateString('en-GB', {
	  day: '2-digit', month: 'short', year: 'numeric'
	});
	const time = now.toLocaleTimeString('en-GB', {
	  hour: '2-digit', minute: '2-digit', second: '2-digit'
	});
	document.getElementById('date').textContent = date;
	document.getElementById('clock').textContent = time;
  }

setInterval(updateClock, 1000);
updateClock();

document.addEventListener("DOMContentLoaded", function () {
	const switchMode = document.getElementById('switch-mode');
	const body = document.body;

	// Cek apakah mode gelap sudah disimpan di localStorage
	if (localStorage.getItem("mode") === "dark") {
		switchMode.checked = true;
		body.classList.add('dark');
	}

	switchMode.addEventListener('change', function () {
		if (this.checked) {
			body.classList.add('dark');
			localStorage.setItem("mode", "dark");
		} else {
			body.classList.remove('dark');
			localStorage.setItem("mode", "light");
		}
	});
});
