import React from 'react';
import ReactDOM from 'react-dom';
import Navbar from './Navbar';

export default class App extends React.PureComponent {
    render() {
        return(
            <Navbar/>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App/>, document.getElementById('app'));
}
