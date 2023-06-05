import React from 'react';
import './category-item.styles.scss';
const CategoryItem = ({ category }) => {
  return (
    <div
      className="category-container"
      style={{ backgroundImage: `url(${category.img})` }}
    >
      <div className="background-image" />
      {/** img */}
      <div className="category-body-container">
        <h2>{category.title}</h2>
        <p>Shop Now</p>
      </div>
    </div>
  );
};
export default CategoryItem;
