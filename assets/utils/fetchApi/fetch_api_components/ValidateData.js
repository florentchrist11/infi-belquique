import axios from "axios";
import NotificationsReponse from "./NotificationsReponse";

function ValidateData(sendData, url, data, setData, setTotalItems, setLoading) {
    setLoading(true)
    axios.post(url, sendData).then(response => {
        setData(response.data)
        setLoading(false)
        NotificationsReponse(response)
    }).catch((error) => {
        NotificationsReponse(error, setData)
        setLoading(false)
    })
}

export default ValidateData;