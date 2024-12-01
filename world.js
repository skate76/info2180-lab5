document.getElementById('lookup').addEventListener('click', function (){
    const country = document.getElementById('country').value;


    if(!country){
        alert('Please enter a country name');
        return;

    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `world.php?country=${encodeURIComponent(country)}`, true);

    xhr.onload = function(){
        if(xhr.status === 200){
            const data = JSON.parse(xhr.responseText);
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '';

            if(data.length > 0){
                data.forEach(item => {
                    const p = document.createElement('p');
                    p.textContent = `${item.name} is ruled by ${item.head_of_state}`;
                    resultDiv.appendChild(p);

                });
            }else{
                resultDiv.textContent = 'No results found.';
            }
        }
    };
    xhr.send();


});