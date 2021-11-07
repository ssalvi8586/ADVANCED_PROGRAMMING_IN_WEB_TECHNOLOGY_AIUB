let baseUrl = 'http: //127.0.0.1:8000';
const RequestUrl = {
    getCategorySearchResult = keyword => {
        return `${baseUrl}/admin/categories/search/${keyword}`
    }
}