import React from 'react';

export default class Post extends React.Component {
    render() {
        let post = this.props.post;
        return (
            <div>
                <a href={window.location.href + "/posts/" + post.getAttribute('data-id')}>
                    {post.getAttribute('data-date')}
                    <h3>{post.getAttribute('data-title')}</h3>
                    {post.getAttribute('data-content')}
                </a>
            </div>
        );
    }
}