import Footer from '@/layouts/Footer';
import Header from '@/layouts/header';
import { PaginationProps, Product } from '@/types';
import ProductList from './ProductList';

export default function Home({
    products,
}: {
    products: PaginationProps<Product>;
}) {
    return (
        <>
            <Header title="Welcome" />
            <div className="grid grid-cols-1 gap-8 p-8 md:grid-cols-2 lg:grid-cols-3">
                {products.data.map((product) => (
                    <ProductList product={product} />
                ))}
            </div>
            <Footer />
        </>
    );
}
