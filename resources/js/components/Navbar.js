import React from 'react';
import Axios from 'axios';
import DropDown from './DropDown';
import MedicineCard from './MedicineCard';

export default class Navbar extends React.PureComponent {
    constructor(props) {
        super(props);
        this.state = {
            manufacturers: null,
            products: null,
            manufacturerProducts: null
        };

        this.getManufacturers = this.getManufacturers.bind(this);
        this.getProducts = this.getProducts.bind(this);
        this.getProductsByManufacturers = this.getProductsByManufacturers.bind(this);

        Axios.get('/api/manufacturers').then(this.getManufacturers);
        Axios.get('/api/products').then(this.getProducts);
    }

    getManufacturers(response) {
        this.setState({manufacturers: response.data});
    }

    getProducts(response) {
        this.setState({products: response.data});
    }

    getProductsByManufacturers(id) {
        var parentObject = this;
        Axios.get('/api/manufacturer-product/' + id).then(function (response) {
            parentObject.setState({manufacturerProducts: response.data});
        });
    }

    render() {
        return (
            <React.Fragment>
            <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                <div className="container">
                    <a className="navbar-brand" href="/">Pharmacy</a>
                    <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"></span>
                    </button>

                    <div className="collapse navbar-collapse" id="navbar">
                        <ul className="navbar-nav ml-auto">
                            <li className="nav-item active">
                                <a className="nav-link" href="/">All products</a>
                            </li>
                            {
                                this.state.manufacturers &&
                                <DropDown dropDownName={'Manufacturer'} manufacturerMethod={this.getProductsByManufacturers} manufacturersItems={this.state.manufacturers}/>
                            }
                        </ul>
                    </div>
                </div>
            </nav>
                <div className="container">
                    <div className="row">
                        {
                            this.state.manufacturerProducts && <MedicineCard productData={this.state.manufacturerProducts}/> ||
                                this.state.products && <MedicineCard productData={this.state.products}/>
                        }
                    </div>
                </div>
            </React.Fragment>
        );
    }
}
