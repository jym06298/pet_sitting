// need to use this function to go through DB and pull all the orders based on the animal they selected

function clickedSubmit() {
    //alert("Button was clicked");
    let bodyElement = document.getElementById("results");

    let cardElement = document.createElement("div");
    let imgContainer = document.createElement("div");
    let infoContainer = document.createElement("div");
    let imgElement = document.createElement("img");
    let headingElement = document.createElement("h5");
    let paragraphElement = document.createElement("p");
    let btnElement = document.createElement("a");

    cardElement.className = "card";
    imgContainer.className = "image-container";
    infoContainer.className = "info-container";
    imgElement.className = "img";
    headingElement.className = "heading";
    paragraphElement.className = "paragraph";
    btnElement.className = "btn";

    imgElement.src = "https://source.unsplash.com/random";
    btnElement.setAttribute("href", "#");
    imgElement.setAttribute("alt", "Image from unsplash");
    headingElement.innerText="Unsplash";
    paragraphElement.innerText="nytn hrtntrnjr jnryjtrnrn hrtdyn";
    btnElement.innerText="Learn More";

    bodyElement.appendChild(cardElement);
    cardElement.append(imgContainer, infoContainer);
    imgContainer.appendChild(imgElement);
    infoContainer.append(headingElement, paragraphElement, btnElement);
    
}
