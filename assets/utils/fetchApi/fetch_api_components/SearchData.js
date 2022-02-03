import axios from "axios";
import NotificationsReponse from "./NotificationsReponse";

function SearchData(q, url, data, setData, setTotalItems, setLoading, setQuery) {
    setLoading(true)
    const cancelToken = axios.CancelToken;
    const source = cancelToken.source();

    axios.get(url + q, {cancelToken: source.token})
        .then(response => {
            response.data['hydra:member'] ? setData(response.data['hydra:member']) : setData(response.data)
            setTotalItems(response.data['hydra:totalItems'])
            setQuery(q)
            setLoading(false)
            NotificationsReponse(response.data)
        }).catch((error) => {
        NotificationsReponse(error, setData)
        setLoading(false)
    })
}

export default SearchData;