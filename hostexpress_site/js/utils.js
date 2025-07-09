export function addCleave(id, type){
    if(type === "phone"){
        new Cleave('#' + id + '', {
            numericOnly: true,
            blocks: [ 0, 2, 5, 4 ],
            delimiters: [ "(", ")", "-", "" ]
        });
    } else if (type === "cpf") {
        new Cleave('#' + id + '', {
            numericOnly: true,
            blocks: [ 3, 3, 3, 2 ],
            delimiters: [ ".", ".", "-", "" ]
        });
    } else if (type === "cep") {
        new Cleave('#' + id + '', {
            numericOnly: true,
            blocks: [5, 3],
            delimiters: [ "-", ""]
        });
    }
}

export function removeMask(str) {
    str.replace(/\D/g, '');
    str.replace(" ","");
    return str;
}