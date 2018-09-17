import React from 'react';

export default class MedicineCard extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <React.Fragment>
                {
                    this.props.productData.map((product) => {
                        return <div key={product.id} className='col-sm-12 col-md-6 col-lg-4 col-xl-3 my-3'>
                            <div className="card">
                                <img className="card-img-top" src={"../images/" + product.poster} alt={product.name}/>
                                <div className="card-body p-2 pt-4">
                                    <h5 className="card-title">{product.name}</h5>
                                    <p className="card-text">{product.description}</p>
                                </div>
                                <ul className="list-group list-group-flush">
                                    <li className="list-group-item px-2 py-1"><span>Available:</span> &nbsp;
                                        {
                                            (product.available) ? <i className="fa fa-check-circle-o"></i> : <i className="fa fa-minus-circle"></i>
                                        }
                                    </li>
                                    <li className="list-group-item px-2 py-1"><span>Price:</span> {product.price} <i className='fa fa-ruble'></i></li>
                                    <li className="list-group-item px-2 py-1"><span>Date:</span> {product.from +' / '+ product.to}</li>
                                    <li className="list-group-item px-2 py-1"><span>Manufacturer:</span> {product.manufacturer.name}</li>
                                    <li className="list-group-item px-2 py-1"><span>Purpose:</span> {product.purpose.name}</li>
                                </ul>
                            </div>
                        </div>
                    })
                }
            </React.Fragment>
        );
    }
}
