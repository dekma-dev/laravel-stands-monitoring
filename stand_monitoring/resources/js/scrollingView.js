let btn = document.getElementById('scrollButton')

function magic() {
  if (window.scrollY > 20) {
  btn.style.opacity = '1'
  } else { btn.style.opacity = '0' }
}

btn.onclick = function () {
	window.scrollTo(0,0)
}

window.onscroll = magic