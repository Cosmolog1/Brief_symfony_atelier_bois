const newmap = document.querySelector("#map");
let coordo = newmap.getAttribute("data-coordo");

const obj = JSON.parse(coordo);
console.log(obj[0].latitude);

console.log(coordo);
let map = L.map("map").setView([obj[0].latitude, obj[0].longitude], 13);

let osm = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
});
osm.addTo(map);
let marker = L.marker([45.75985, 3.13153]).addTo(map);
