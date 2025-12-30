import { logout } from '@/routes';
import { Head, Link } from '@inertiajs/react';

export default function Header({ title }: { title: string | null }) {
    const appName = import.meta.env.VITE_APP_NAME;

    return (
        <div>
            <Head title={title ? title : appName}></Head>

            <div className="navbar bg-base-100 shadow-sm">
                <div className="flex-1">
                    <a href="/" className="btn text-xl btn-ghost">
                        Laravel Ecomm
                    </a>
                </div>
                <div className="flex-none">
                    <div className="dropdown dropdown-end mr-5">
                        <div
                            tabIndex={0}
                            role="button"
                            className="btn btn-circle btn-ghost"
                        >
                            <div className="indicator">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    className="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                                <span className="indicator-item badge badge-sm">
                                    8
                                </span>
                            </div>
                        </div>
                        <div
                            tabIndex={0}
                            className="card-compact dropdown-content card z-1 mt-3 w-52 bg-base-100 shadow"
                        >
                            <div className="card-body">
                                <span className="text-lg font-bold">
                                    8 Items
                                </span>
                                <span className="text-info">
                                    Subtotal: $999
                                </span>
                                <div className="card-actions">
                                    <button className="btn btn-block btn-primary">
                                        View cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="dropdown dropdown-end">
                        <div
                            tabIndex={0}
                            role="button"
                            className="btn avatar btn-circle btn-ghost"
                        >
                            <div className="w-10 rounded-full">
                                <img
                                    alt="Tailwind CSS Navbar component"
                                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                                />
                            </div>
                        </div>
                        <ul className="dropdown-content menu z-1 mt-3 w-52 menu-sm rounded-box bg-base-100 p-2 shadow">
                            {/* <li>
                                    <a className="justify-between">
                                        Profile
                                        <span className="badge">New</span>
                                    </a>
                                </li>
                                <li>
                                    <a>Settings</a>
                                </li> */}
                            <li>
                                <Link href={logout()}>Logout</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    );
}
