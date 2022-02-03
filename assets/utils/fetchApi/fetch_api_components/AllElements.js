import axios from "axios";
import NotificationsReponse from "./NotificationsReponse";

function AllElements(url, setData, setTotalItems, setLoading) {
    setLoading(true)
    axios.get(url).then(response => {
        response.data['hydra:member'] ? setData(response.data['hydra:member']) : setData(response.data)
        setTotalItems(response.data['hydra:totalItems'])
        setLoading(false)
        NotificationsReponse(response)
    }).catch((error) => {
        NotificationsReponse(error, setData)
        setLoading(false)
    })
}

export default AllElements;