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

export default async function getUserLocation() {
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