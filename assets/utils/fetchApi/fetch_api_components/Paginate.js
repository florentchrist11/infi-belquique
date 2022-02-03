import axios from "axios";
import NotificationsReponse from "./NotificationsReponse";

function Paginate(number, query, cancel, setData, setTotalItems, setLoading) {
    setLoading(true)
    let dataPaginator = '';
    query.length > 0 ? dataPaginator = `${query}&page=${number}` : dataPaginator = `?page=${number}`

    axios.get(url + dataPaginator, {cancelToken: cancel.token})
        .then(response => {
            response.data['hydra:member'] ? setData(response.data['hydra:member']) : setData(response.data)
            setLoading(false)
            NotificationsReponse(response)
        }).catch((error) => {
        NotificationsReponse(error)
        setLoading(false)
    })
}

export default Paginate;