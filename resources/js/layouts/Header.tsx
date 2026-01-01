import MiniCartDropDown from '@/components/MiniCartDropDown';
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
                    <MiniCartDropDown />
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
