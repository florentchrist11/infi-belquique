import axios from "axios";
import NotificationsReponse from "./NotificationsReponse";

function PatchData(id, sendData, url, data, setData, setTotalItems, setLoading) {
    setLoading(true)
    axios.patch(url + '/' + id, sendData).then(response => {
        setData(response.data)
        setLoading(false)
        NotificationsReponse(response)
    }).catch((error) => {
        NotificationsReponse(error, setData)
        setLoading(false)
    })
}

export default PatchData;