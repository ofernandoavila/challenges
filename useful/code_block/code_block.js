const copyCodeBlock = document.querySelector('.code_preview button.copy');

copyCodeBlock.addEventListener('click', (event) => {
    event.preventDefault();

    let out = "";

    let lines = document.querySelectorAll('.code_preview .line');

    lines.forEach( line => {
        out += line.textContent + '\n';
    });

    navigator.clipboard.writeText(out);
    document.querySelector('.code_preview button.copy span').innerHTML = "Copied!";
});