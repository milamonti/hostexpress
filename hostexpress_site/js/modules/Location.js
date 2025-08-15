function getUserCoordinates() {
  return new Promise((resolve, reject) => {
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(
        posicao => {
          const latitude = posicao.coords.latitude;
          const longitude = posicao.coords.longitude;
          resolve({ latitude, longitude });
        },
        erro => {
          console.error("Erro ao obter localização:", erro.message);
          reject(erro);
        }
      );
    } 
    else {
      reject(console.error("Geolocalização não é suportada neste navegador."));
    }
  });
}

async function getUserLocation() {
  try {
    const { latitude, longitude } = await getUserCoordinates();

    const response = await fetch(
      `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`
    )
    .then((res) => res.json())
    .catch((e) => console.log('Erro getting user location', e.message));
    
    return response;
  } catch (e) {
    console.error(e.message);
  }
}

export default function handleUserLocation() {
  localStorage.getItem("address")
  ? $("#location").text(localStorage.getItem("address"))
  : getUserLocation()
    .then((result) => {
      $("#location").text(
        result.address.neighbourhood
          ? `${result.address.neighbourhood} - ${result.address.city}`
          : `${result.address.city}`
      );
      localStorage.setItem("address", $("#location").text());
    })
    .catch((e) => console.error("Error getting user location:", e));
}
