import React, { Component } from "react";

import CartModal from "./modals/CartModal";

import {
  IoLogoTwitter as TwitterLogo,
  IoLogoFacebook as FacebookLogo,
  IoLogoInstagram as InstagramLogo,
  IoIosMusicalNotes as SpotifyLogo,
  //IoMdCart as CartIcon,
} from "react-icons/io";

class Navbar extends Component {
  // @TODO: Hide Logo when "Header" Component is scrolled "through"
  constructor(props) {
    super(props);

    this.state = {
      scrolled: false
    }

    this.renderCart = this.renderCart.bind(this);
  }

  componentDidMount() {
    window.addEventListener("scrolled", () => {
      const isTop = window.scrollY < 50;

      if (isTop !== true) {
        this.setState({ scrolled: true });
      } else {
        this.setState({ scrolled: false });
      }
    });
  }

  componentWillUnmount() {
    // window.removeEventListener("scroll");
    // @TODO: 
    // - actually excepts two arguments
    // - second one must be a variable that stores the eventListener
  }


  onHover() {
    // @TODO: turn down the opacity of all elements 
  }

  renderCart() {
      // @TODO
  }

  render() {
    return (
      <nav className={this.state.scrolled ? "navbar navbar--fixed" : "navbar"}>
          <ul className="navbar__socials">
            <li className="navbar__socials--twitter">
              <a href="">
                <TwitterLogo />
              </a>
            </li>
            <li className="navbar__socials--facebook">
              <a href="">
                <FacebookLogo />
              </a>
            </li>
            <li className="navbar__socials--instagram">
              <a href="">
                <InstagramLogo />
              </a>
            </li>
            <li className="navbar__socials--spotify">
              <a href="">
                <SpotifyLogo />
              </a>
            </li>
          </ul>

          <ul className="navbar__navigation">
            <li className="navbar__navigation-tours">
              <a href="">
                Tours
              </a>
            </li>
            <li className="navbar__navigation-music">
              <a href="">
                Music
              </a>
            </li>
            <li className="navbar__navigation-home">
              <a href="">
                Home
              </a>
            </li>
            <li className="navbar__navigation-merch">
              <a href="">
                Merch
              </a>
            </li>
            <li className="navbar__navigation-contact">
              <a href="">
                Contact
              </a>
            </li>
          </ul>

          <div className="navbar__cart">
            <CartModal />
          </div>
      </nav>
    );
  }
}

export default Navbar;
