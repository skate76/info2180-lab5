document.addEventListener("DOMContentLoaded", function() {
    const lookupButton = document.getElementById('lookup');
    const cityLookupButton = document.getElementById('citylookup');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');

    
    lookupButton.addEventListener('click', function() {
        const country = countryInput.value.trim();

        if (!country) {
            resultDiv.innerHTML = '<p>Please enter a country name to lookup.</p>';
            return;
        }

        fetchCountry(country);
    });

  
    cityLookupButton.addEventListener('click', function() {
        const country = countryInput.value.trim();

        if (!country) {
            resultDiv.innerHTML = '<p>Please enter a country name to lookup cities.</p>';
            return;
        }

        fetchCities(country);
    });

 
    function fetchCountry(country) {
        const xhr = new XMLHttpRequest();
        const url = `world.php?country=${encodeURIComponent(country)}&lookup=country`;

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

    
    function fetchCities(country) {
        const xhr = new XMLHttpRequest();
        const url = `world.php?country=${encodeURIComponent(country)}&lookup=cities`;

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
