document.addEventListener("DOMContentLoaded", function() {
    const lookupButton = document.getElementById('lookup');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');

   
    lookupButton.addEventListener('click', function() {
        const country = countryInput.value.trim();

       
        if (!country) {
            resultDiv.innerHTML = '<p>Loading all countries...</p>';
            fetchCountries();
            return;
        }

        fetchCountry(country);
    });

    
    function fetchCountries() {
        const xhr = new XMLHttpRequest();
        const url = `world.php`;  

        xhr.open('GET', url, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                resultDiv.innerHTML = xhr.responseText;  
            } else {
                resultDiv.innerHTML = '<p>Error fetching data from the server.</p>';
            }
        };

        xhr.onerror = function() {
            resultDiv.innerHTML = '<p>Request failed.</p>';
        };

        xhr.send();
    }

    
    function fetchCountry(country) {
        const xhr = new XMLHttpRequest();
        const url = `world.php?country=${encodeURIComponent(country)}`;

        xhr.open('GET', url, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                resultDiv.innerHTML = xhr.responseText;  
            } else {
                resultDiv.innerHTML = '<p>Error fetching data from the server.</p>';
            }
        };

        xhr.onerror = function() {
            resultDiv.innerHTML = '<p>Request failed.</p>';
        };

        xhr.send();
    }
});
