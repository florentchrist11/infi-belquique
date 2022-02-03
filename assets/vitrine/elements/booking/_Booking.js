import React from "react";
import {render, unmountComponentAtNode} from "react-dom";
import Booking from "./Booking";

class _Booking extends HTMLElement {

    connectedCallback() {
        let idCategorie = this.getAttribute('idCategorie')
        render(<Booking idCategorie={idCategorie}/>, this)
    }


    disconnectedCallback() {
        unmountComponentAtNode(this)
    }
}

customElements.define('booking-systems', _Booking)