const copyCodeBlock = document.querySelector('.code_preview button.copy');

copyCodeBlock.addEventListener('click', (event) => {
    event.preventDefault();

    let out = "";

    let lines = document.querySelectorAll('.code_preview .line');

    lines.forEach(line => {
        out += line.textContent + '\n';
    });


    if (navigator.clipboard) {
        navigator.clipboard.writeText(out).then(function () {
            alert("Texto copiado para a área de transferência.");
        }, function () {
            let areaDeTransferencia = document.createElement("textarea");
            areaDeTransferencia.value = out;
            document.body.appendChild(areaDeTransferencia);
            areaDeTransferencia.select();
            document.execCommand("copy");
            document.body.removeChild(areaDeTransferencia);
        });
    } else {
        let areaDeTransferencia = document.createElement("textarea");
        areaDeTransferencia.value = out;
        document.body.appendChild(areaDeTransferencia);
        areaDeTransferencia.select();
        document.execCommand("copy");
        document.body.removeChild(areaDeTransferencia);
    }

    document.querySelector('.code_preview button.copy span').innerHTML = "Copied!";
});