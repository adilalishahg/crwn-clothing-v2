import React from 'react';
import './categories.style.scss';
import Directory from './directory/directoy.component';
const App = () => {
  const categories = [
    {
      title: 'Hats',
      id: '1',
      img: 'https://mikadopersonalstyling.com/wp-content/uploads/2020/06/fashion-tips.jpg',
    },
    {
      title: 'Jackets',
      id: '2',
      img: 'https://mikadopersonalstyling.com/wp-content/uploads/2020/06/fashion-tips.jpg',
    },
    {
      title: 'Sneakers',
      id: '3',
      img: 'https://mikadopersonalstyling.com/wp-content/uploads/2020/06/fashion-tips.jpg',
    },
    {
      title: 'Shoes',
      id: '4',
      img: 'https://mikadopersonalstyling.com/wp-content/uploads/2020/06/fashion-tips.jpg',
    },
    {
      title: 'Men ',
      id: '5',
      img: 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ties.com%2Fblog%2F10-things-women-find-most-attractive-in-mens-style&psig=AOvVaw3qcD77Y_IQJga1cp7vjmyQ&ust=1686036529459000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCODCgtXNq_8CFQAAAAAdAAAAABAE',
    },
  ];
  return <Directory categories={categories} />;
};
export default App;
