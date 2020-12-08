
document.getElementById("submit").addEventListener("click",()=>{
    
    document.querySelectorAll("iframe").forEach(element => {
        element.remove();
    });
    
    fetch("https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&q="+"recipe" + document.getElementById("research").value.trim().replace(/ +/g, " ").replaceAll(" ","+")+"&type=video&key=AIzaSyAFNjqD-9Vc2ajS4pwAS2MhFNMbD4Ca4CA")
    .then(response=>response.json()).then((data)=>{
        console.log(data);
        data.items.forEach(element => {
            let iframe = document.createElement("iframe");
            iframe.setAttribute("src","https://www.youtube.com/embed/"+element.id.videoId);
            iframe.setAttribute("class","youtube");
            iframe.setAttribute("frameborder","0");
            iframe.setAttribute("allow","accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
            iframe.setAttribute("allowfullscreen","");
            document.querySelector("body").insertAdjacentElement("beforeend", iframe);

            // add form for save video in user-account
            let form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', 'user.php');

            let inputHidden = document.createElement('input');
            inputHidden.setAttribute('type', 'hidden');
            inputHidden.setAttribute('name', 'data');
            inputHidden.setAttribute('value', "https://www.youtube.com/embed/" + element.id.videoId);
            form.appendChild(inputHidden);

            let inputSubmit = document.createElement('input');
            inputSubmit.setAttribute('type', 'submit');
            inputSubmit.setAttribute('name', 'save-video');
            inputSubmit.setAttribute('value', 'Save this video in my account');
            form.appendChild(inputSubmit);

            document.querySelector("body").insertAdjacentElement("beforeend", form);

            console.log(form);
        });
    })
    
})


