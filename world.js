document.getElementById('lookup').addEventListener('click', function () {
    const country = document.getElementById('country').value.trim();

    if (!country) {
        alert('Please enter a country name');
        return;
    }

    fetch(`world.php?country=${encodeURIComponent(country)}`)
    .then(response => {
        if(!response.ok){
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = '';

        if(data.length > 0){
            data.forEach(item => {
                const p = document.createElement('p');
                p.textContent = `${item.name} is ruled by ${item.head_of_state}`;
                resultDiv.appendChild(p);
            });
        } else{
            resultDiv.textContent = 'No results found';
        }
    })
    .catch(error => {
        console.error('Error during fetch operation:' , error);
        document.getElementById('result').textContent = 'An error occurred while fetching the data';
    });
});

    /*const xhr = new XMLHttpRequest();
    xhr.open('GET', `world.php?country=${encodeURIComponent(country)}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const data = JSON.parse(xhr.responseText);
                const resultDiv = document.getElementById('result');
                resultDiv.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(item => {
                        const p = document.createElement('p');
                        p.textContent = `${item.name} is ruled by ${item.head_of_state}`;
                        resultDiv.appendChild(p);
                    });
                } else {
                    resultDiv.textContent = 'No results found.';
                }
            } catch (error) {
                console.error('Error parsing JSON:', error);
                document.getElementById('result').textContent = 'An error occurred.';
            }
        } else {
            console.error('Request failed:', xhr.statusText);
            document.getElementById('result').textContent = 'Failed to fetch data.';
        }
    };

    xhr.onerror = function () {
        console.error('Request error');
        document.getElementById('result').textContent = 'An error occurred during the request.';
    };

    xhr.send();
});*/