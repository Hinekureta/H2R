import React from 'react';
import ReactDOM from 'react-dom';
import PostList from './components/PostList'

// class PostsList extends React.Component {
//     render() {
//         var rows = [];
//         var postZones = document.getElementsByClassName('post-zone');
//         for (var i = 0; i < postZones.length; ++i) {
//             var post = postZones[i];
//             rows.push(
//                 <div key={i}>
//                     <a href={window.location.href + "/posts/" + post.getAttribute('data-id')}>
//                         {post.getAttribute('data-date')}
//                         <h3>{post.getAttribute('data-title')}</h3>
//                         {post.getAttribute('data-content')}
//                     </a>
//                 </div>
//             );
//         }
//         return (
//             <div>{rows}</div>
//         );
//     }
// }

ReactDOM.render(
    <PostList posts={document.getElementsByClassName('post-zone')}/>,
    document.getElementById('root')
);