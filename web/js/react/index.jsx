import React from 'react';
import ReactDOM from 'react-dom';
import PostList from './components/PostList'

ReactDOM.render(
    <PostList posts={document.getElementsByClassName('post-zone')}/>,
    document.getElementById('root')
);