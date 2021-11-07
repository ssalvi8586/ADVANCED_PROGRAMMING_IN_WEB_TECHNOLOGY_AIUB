async function getResult(url) {
    let response = await fetch(url);
    let data = await response.json();
    return data;
}
getResult(RequestUrl.getCategorySearchResult(keyword))
    .then(data => {
        console.log(data);
    })