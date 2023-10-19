const APIKey = 'c2bd5a0801msh57cd482c54acc16p1a7d27jsna533972fdcce';
const APIHost = 'netflix-data.p.rapidapi.com';
const titleID = '80057281';
const APIURL = `https://${APIHost}/title/trailers/?id=${titleID}`;

window.addEventListener('load', loadData);

async function loadData() {
    try {
        const response = await fetch(APIURL, {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': APIKey,
                'X-RapidAPI-Host': APIHost
            }
        });

        if (response.ok) {
            const data = await response.json();
            console.log(data);
        } else {
            console.error('API request failed.');
        }
    } catch (error) {
        console.error(error);
    }
}



