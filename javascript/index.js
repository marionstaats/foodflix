
document.getElementById("submit").addEventListener("click",()=>{
    document.querySelectorAll("iframe").forEach(element => {
        element.remove();
    });
    
    fetch("https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&q="+"recipe" + document.getElementById("research").value.trim().replace(/ +/g, " ").replaceAll(" ","+")+"&type=video&key=AIzaSyAFNjqD-9Vc2ajS4pwAS2MhFNMbD4Ca4CA")
    .then(response=>response.json()).then((data)=>{
        data.items.forEach(element => {
            let iframe = document.createElement("iframe");
            iframe.setAttribute("src","https://www.youtube.com/embed/"+element.id.videoId);
            iframe.setAttribute("class","youtube");
            iframe.setAttribute("frameborder","0");
            iframe.setAttribute("allow","accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
            iframe.setAttribute("allowfullscreen","");
            document.querySelector("body").insertAdjacentElement("beforeend", iframe);
        });
    })
})
