import React from 'react';
import Post from './Post';
export default class PostList extends React.Component {
    render() {
        let posts = this.props.posts;
        var rows = [];
        for (var i = 0; i < posts.length; ++i) {
            let post = posts[i];
            rows.push(<Post key={i} post={post}/>)
        }

        return (<div>{rows}</div>);
    }
}