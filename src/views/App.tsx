import React from 'react';
import logo from './assets/logo.png';

const App: React.FC = () => {
  return (
    <div className="App">
      <div className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <h2>Welcome to Nebula!</h2>
      </div>
      <div className="App-intro">
        <p>Controllers are served in <code><a href="/api">/api</a></code></p>
        <p>To get started, edit <code>app\views\App.tsx</code> and save.</p>
      </div>
    </div>
  )
};

export default App;
