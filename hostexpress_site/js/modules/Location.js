function getUserCoordinates() {
  return new Promise((resolve, reject) => {
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(
        posicao => {
          const latitude = posicao.coords.latitude;
          const longitude = posicao.coords.longitude;

          $("#coordenadas").val(latitude + "/" + longitude);
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
    .catch((e) => console.log(e));
    
    return await response.json();
  } catch (e) {
    console.error(e.message);
  }
}

export default function handleUserLocation() {
  localStorage.getItem("address")
  ? $("#cidade").text(localStorage.getItem("address"))
  : getUserLocation()
    .then((result) => {
      $("#cidade").text(
        result.address.neighbourhood
          ? `${result.address.neighbourhood} - ${result.address.city}`
          : `${result.address.city}`
      );
      localStorage.setItem("address", $("#cidade").text());
    }).catch((e) => {
      console.error("Error getting user location:", e);
    });
} 