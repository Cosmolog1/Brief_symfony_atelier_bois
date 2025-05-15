// Sélection de la div map via son id
const newmap = document.querySelector("#map");
// Lecture du data coordo présent dans le twig en Json via la variable coordo
let coordo = newmap.getAttribute("data-coordo");

// Transformation du JSON en string aprés convertion pour devenir un tableau
const obj = JSON.parse(coordo);

// Récupération des données latitude et longitude dans tableau issue du JSON
let map = L.map("map").setView([obj[0].latitude, obj[0].longitude], 13);

// Récuêration de la maps via bibliothéque leaflet
let osm = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
});
osm.addTo(map);
// Ajout d'un marquer de postion
let marker1 = L.marker([obj[0].latitude, obj[0].longitude]).addTo(map);
marker1.bindPopup("Simplon");
let marker2 = L.marker([obj[1].latitude, obj[1].longitude]).addTo(map);
marker2.bindPopup("Hall du brézet");
