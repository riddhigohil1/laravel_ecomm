import MiniCartDropDown from '@/components/MiniCartDropDown';
import { dashboard, login, logout, register } from '@/routes';
import { SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import { useEffect, useRef, useState } from 'react';

export default function Header({ title }: { title: string | null }) {
    const appName = import.meta.env.VITE_APP_NAME;
    const { auth, error, success } = usePage<SharedData>().props;

    const [successMessage, setSuccessMessage] = useState([]);
    //Ref to store timeouts for each message
    const timeOutRef = useRef<{ [key: number]: ReturnType<typeof setTimeout> }>(
        {},
    );

    useEffect(() => {
        if (success.message) {
            const newMessage = {
                ...success,
                id: success.time, // use time as unique identifier
            };

            //Add the new message to the list
            setSuccessMessage((prevMessages): any => [
                newMessage,
                ...prevMessages,
            ]);

            //set a timeout for specific message
            const timeoutId = setTimeout(() => {
                //use a functionl update to ensure the latest state is used
                setSuccessMessage((prevMessages) =>
                    prevMessages.filter((msg: any) => msg.id !== newMessage.id),
                );
                //clear timeout from refs after execution
                delete timeOutRef.current[newMessage.id];
            }, 5000);

            //Store timeout id in the ref
            timeOutRef.current[newMessage.id] = timeoutId;
        }
    }, [success]);

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
                    {auth.user ? (
                        <div className="dropdown dropdown-end mx-4">
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
                            <ul
                                tabIndex={0}
                                className="dropdown-content menu z-1 mt-3 w-52 menu-sm rounded-box bg-base-100 p-2 shadow"
                            >
                                <li>
                                    <Link
                                        href={dashboard()}
                                        className="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                                    >
                                        Dashboard
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href={logout()}
                                        className="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                                    >
                                        Logout
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    ) : (
                        <>
                            <Link href={login()} className="btn mx-4">
                                Log in
                            </Link>
                            <Link href={register()} className="btn btn-primary">
                                Register
                            </Link>
                        </>
                    )}
                </div>
            </div>

            {successMessage.length > 0 && (
                <div className="toast toast-end toast-top z-[1000] mt-16">
                    {successMessage.map((msg: any) => (
                        <div className="alert alert-success" key={msg.id}>
                            <span>{msg.message}</span>
                        </div>
                    ))}
                </div>
            )}

            {error && (
                <div className="p-8 text-red-500">
                    <div className="alert alert-error">{error}</div>
                </div>
            )}
        </div>
    );
}
