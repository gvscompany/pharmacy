import React from 'react';

export default class DropDown extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    anyMethod(id) {
        this.props.manufacturerMethod(id);
    }

    render() {
        var parentObj = this;
        return(
            <li className="nav-item dropdown">
                <a className="nav-link dropdown-toggle" href="#" id="navbarD" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {this.props.dropDownName}
                </a>
                <div className="dropdown-menu" aria-labelledby="navbarD">
                    {
                        this.props.manufacturersItems.map(item => {
                            return <a className="dropdown-item" onClick={function (e) {
                                e.preventDefault();
                                parentObj.anyMethod(item.id);
                            }} key={item.id} href="#">{item.name}</a>
                        })
                    }
                </div>
            </li>
        );
    }
}
