const userInput = document.querySelector("#userInput");
const inputDMS = document.querySelector("#inputDMS");
const inputDD = document.querySelector("#inputDD");
const inputDM = document.querySelector("#inputDM");
const copyUserInput = document.querySelector("#copyInput");
const copyDMS = document.querySelector("#copyDMS");
const copyDD = document.querySelector("#copyDD");
const copyDM = document.querySelector("#copyDM");
const pasteInput = document.querySelector("#pasteInput");
const copyInputIcon = document.querySelector("div.userInput .bi-clipboard")
const copyDMSicon = document.querySelector("div.DMSformat .bi-clipboard")
const copyDDicon = document.querySelector("div.DDformat .bi-clipboard")
const copyDMicon = document.querySelector("div.DMformat .bi-clipboard")
const pasteInputIcon = document.querySelector("div.userInput .bi-clipboard-data")

userInput.addEventListener("input", inputInputed);

function inputInputed() {
    const format = Coordinates.whatFormat(userInput.value);
    let dms, dd, dm;
    switch (format) {
        case Coordinates.DMS:
            dms = Coordinates.cleanString(userInput.value);
            dd = Coordinates.DMStoDD(userInput.value);
            dm = Coordinates.DMStoDM(userInput.value);
            break;
        case Coordinates.DD:
            dms = Coordinates.DDtoDMS(userInput.value);
            dd = Coordinates.cleanString(userInput.value);
            dm = Coordinates.DDtoDM(userInput.value);
            break;
        case Coordinates.DM:
            dms = Coordinates.DMtoDMS(userInput.value);
            dd = Coordinates.DMtoDD(userInput.value);
            dm = Coordinates.cleanString(userInput.value);
            break;
        default:
            dms = "";
            dd = "";
            dm = "";
            break;
    }
    inputDMS.value = dms;
    inputDD.value = dd;
    inputDM.value = dm;
}

copyUserInput.addEventListener("click", () => {
    navigator.clipboard.writeText(userInput.value);
    changeClipboardIcon(copyInputIcon, "bi-clipboard", "bi-check2");
});

copyDMS.addEventListener("click", () => {
    navigator.clipboard.writeText(inputDMS.value);
    changeClipboardIcon(copyDMSicon, "bi-clipboard", "bi-check2");
});

copyDD.addEventListener("click", () => {
    navigator.clipboard.writeText(inputDD.value);
    changeClipboardIcon(copyDDicon, "bi-clipboard", "bi-check2");
});

copyDM.addEventListener("click", () => {
    navigator.clipboard.writeText(inputDM.value);
    changeClipboardIcon(copyDMicon, "bi-clipboard", "bi-check2");
});

pasteInput.addEventListener("click", () => {
    paste();
    changeClipboardIcon(pasteInputIcon, "bi-clipboard-data", "bi-check2");
});

async function paste() {
    const text = await navigator.clipboard.readText();
    userInput.value = text;
    inputInputed();
}

/**
 * Dotyczy object'u.
 * Zamienia ikonę1 na ikonę2, a po sekundzie przywraca ikonę1.
 */
function changeClipboardIcon(object, icon1, icon2) {
    object.classList.remove(icon1);
    object.classList.add(icon2);
    setTimeout(() => {
        object.classList.remove(icon2);
        object.classList.add(icon1);
    }, 1000)    
}
