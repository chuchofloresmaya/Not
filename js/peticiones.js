document.getElementById("campo").addEventListener("keyup", getCodigos)

function getCodigos(){
	let inputCP = document.getElementById("campo").value
	let lista = document.getElementById("lista")

	let url = "getCodigos.php"
	let formData = new FormData()
	formData.append("campo", inputCP)


	fetch(url, {
		method: "POST",
		body: formData,
		mode: "cors"
	}).then(response => response.json())
	.then(data => {
		list.style.display = 'block'
		lista.innerHTML = data
	}).catch(err => console.log(err));
}